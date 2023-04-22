const mysql = require('mysql2')
const configDB = require('../config/configDB')
const connection = mysql.createConnection(configDB.connection)
const bcrypt = require('bcrypt')
const saltRounds = 10
const generateUserId = require('../functions/generateuserid')


module.exports = {

    putEmailChange: function(req, res, next){
        if(req.user.Email!=req.body.email){
            connection.query("SELECT EMAIL FROM USER WHERE EMAIL = ?",
            [req.body.email],
            function(error, rows, field){
                if(error){
                    console.log(error)
                    res.redirect("/user/grades") 
                }else if(rows.length){
                    req.flash('error', 'Email already taken')
                    res.redirect("/user/grades") 
                }else{
                    connection.query("UPDATE USER SET EMAIL = ? WHERE USER_ID = ?",
                    [req.body.email, req.user.User_id],
                    function(error, rows, fields){
                        if(error){
                            console.log(error)
                            res.redirect("/user/grades") 
                        }else if(rows.length){
                            req.flash('error', 'Email already taken')
                            res.redirect("/user/grades") 
                        }else{
                            req.flash('success', 'Successfully update email')
                            res.redirect("/user/grades") 
                        }
                    })
                }
            })
        }else{
            req.flash('info', 'Same email as old one!')
            return res.redirect('profile')
        }
    },

    putPasswordChange: function(req, res, next){
        connection.query("SELECT PASSWORD FROM USER WHERE USER_ID = ?",
        [req.user.User_id],
        function(error, rows, fields){
            if(error){
                console.log(error)
                res.redirect("/user/grades") 
            }else{
                bcrypt.compare(req.body.oldpassword, rows[0].PASSWORD, function(err, result) {
                    if(err){
                        console.log(err)
                    }
                    if(!result){
                        req.flash('error', 'Wrong Old Password!')
                        res.redirect("/user/grades") 
                    }else{
                        bcrypt.hash(req.body.newpassword, saltRounds, function(err, hash) {
                            connection.query("UPDATE USER SET PASSWORD = ? WHERE USER_ID = ?",
                            [hash, req.user.User_id],
                            function(error, rows, fields){
                                if(error){
                                    console.log(error)
                                    res.redirect("/user/grades") 
                                }else{
                                    req.flash('success', 'Password Changed!')
                                    res.redirect("/user/grades") 
                                }
                            })
                        })
                    }
                })
            }
        })
    },

    getPasswordChange: function(req, res, next){
        return res.render('../frontend/user/password')
    },
    
    getHome:  function(req, res, next){
        return res.render('../frontend/user/login')
    },

    getDashboard:  function(req, res, next){
        return res.render('../frontend/user/dashboard')
    },

    getEmailChange:  function(req, res, next){
        return res.render('../frontend/user/email')
    },

    getAppointment:  function(req, res, next){
        return res.render('../frontend/user/appointment')
    },

    postAppointment: function(req, res, next){
        const data = req.body

        if(data.diagnose=="Yes"){
            req.flash('error', 'You cannot make an appopintment because you have been diagnose with Covid 19');
            res.redirect("/user/appointment") 
        }else if(data.tested=="Yes"){
            req.flash('error', 'You cannot make an appopintment because your neighborhood have been positive with Covid 19');
            res.redirect("/user/appointment") 
        }else{
        generateUserId()
        .then(function(id){
            data.Appointment_id=id
            bcrypt.hash(data.password, saltRounds, function(err, hash) {
                connection.query("INSERT INTO `appointment`(`Appointment_id`, `User_id`, `diagnose`, `symptoms`, `tested`, `neighbor`, `gender`, `date`, `Role`, `email`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [data.Appointment_id, req.user.User_id, data.diagnose, data.symptoms, data.tested, data.neighbor, data.gender, data.date, data.role, req.user.Email], function(Drerr, Drrows){
                    if(Drerr){
                        console.log(Drerr)
                    }else{
                        req.flash('success', 'Successfully Sent an Appointment. Please Wait for the Confirmation. Thankyou')
                        res.redirect("/user/appointment") 
                        }
                    }
                )
            })	
        })
        .catch((err) => console.log(err))
    }
    },


}