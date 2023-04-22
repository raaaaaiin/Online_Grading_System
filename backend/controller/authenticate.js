const mysql = require('mysql2')
const configDB = require('../config/configDB')
const connection = mysql.createConnection(configDB.connection)
const bcrypt = require('bcrypt')
const passport = require('passport')
const saltRounds = 10
const generateUserId = require('../functions/generateuserid')

module.exports = {

    postAdminLogin: function(req, res, next){
        connection.query("SELECT * FROM ADMIN WHERE EMAIL = ? AND PASSWORD = ?", [req.body.email, req.body.password], function(err, Drrows){
            if(err){
                console.log(err)
            }else{
                req.flash('success', 'Successfully Login')
                res.redirect("/admin/dashboard") 
                }
            }
        )
    },
   
    getUserRegister: function(req, res, next){
        return res.render('../frontend/user/register')
    },

    getUserLogin: function(req, res, next){
        return res.render('../frontend/user/login')
    },

        //This function will add new doctor
    postUserRegister: function(req, res, next){
            const data = req.body

            generateUserId()
            .then(function(id){
                data.User_id=id
                bcrypt.hash(data.password, saltRounds, function(err, hash) {
                    connection.query("INSERT INTO `user`(`User_id`, `Name`, `Email`, `Password`) VALUES (?, ?, ?, ?)", [data.User_id, data.name, data.email, hash], function(Drerr, Drrows){
                        if(Drerr){
                            console.log(Drerr)
                        }else{
                            req.flash('success', 'Successfully Register')
                            res.redirect("/authenticate/user/login") 
                            }
                        }
                    )
                })	
            })
            .catch((err) => console.log(err))

        },

        postUserLogin: passport.authenticate('local-login-user', {
            successRedirect : '/user/grades', 
            failureRedirect : 'login', 
            failureFlash : true 
        }),

        postStaffLogin: passport.authenticate('local-login-staff', {
            successRedirect : '/staff/dashboard', 
            failureRedirect : 'login', 
            failureFlash : true 
        }),

        logout: function(req, res, next){ 
            const date = new Date();
            const desc = "Logout";
            connection.query("INSERT INTO `actions`( `name`, `date`, `description`) VALUES (?, ?, ?)", [req.user.Email, date, desc]);
            req.logout()
            req.session.passport.user = null;
            res.redirect("/authenticate/login")
        },


    
}