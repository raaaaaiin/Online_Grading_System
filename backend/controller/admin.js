const mysql = require('mysql2')
const configDB = require('../config/configDB')
const connection = mysql.createConnection(configDB.connection)
const bcrypt = require('bcrypt')
const nodemailer = require('nodemailer')
const saltRounds = 10
const generateUserId = require('../functions/generateuserid')

module.exports = {
   
    getAdminLogin: function(req, res, next){
        return res.render('../frontend/admin/login')
    },

    getAdminLogout: function(req, res, next){
        return res.render('../frontend/admin/login')
    },

    getAdminDashboard: function(req, res, next){
        connection.query("SELECT USER_ID, FNAME, LNAME, EMAIL FROM USER", [], function(error, rows, fields){
            if(error){
                console.log(error)
            }else{
                return res.render('../frontend/admin/dashboard', { row1: rows})
            }
        })
    },

    getAdminAudit: function(req, res, next){
        connection.query("SELECT ID, NAME, DATE, DESCRIPTION FROM ACTIONS", [], function(error, rows, fields){
            if(error){
                console.log(error)
            }else{
                return res.render('../frontend/admin/audit', { row1: rows})
            }
        })
    },

    getAnnouncement: function(req, res, next){
        connection.query("SELECT * FROM USER", [], function(error, rows, fields){
            if(error){
                console.log(error)
            }else{
                return res.render('../frontend/admin/announcement', { row1: rows})
            }
        })
    },

    postAnnouncement: function(req, res, next){
        const data = req.body

        generateUserId()
        .then(function(id){
            data.Announcement_id=id
            bcrypt.hash(data.password, saltRounds, function(err, hash) {
                connection.query("INSERT INTO `announcement`(`Announcement_id`, `description`) VALUES (?, ?)", [data.Announcement_id, data.announce], function(Drerr, Drrows){
                    if(Drerr){
                        console.log(Drerr)
                    }else{
                        req.flash('success', 'Successfully Add Staff')
                        res.redirect("/admin/dashboard") 
                        }
                    }
                )
            })	
        })
        .catch((err) => console.log(err))
    },

    getAdminAddUser: function(req, res, next){
        return res.render('../frontend/admin/adduser')
    },

    getAdminAddStaff: function(req, res, next){
        return res.render('../frontend/admin/addstaff')
    },

    getDeleteUser: function(req, res){
        connection.query("delete from user where user_id=?; ", [req.params.id], (err,rows) => {
            if(err){
                console.log(err)
            }else{
                req.flash('success', 'User deleted')
                return res.redirect('/admin/dashboard')
            }
        })
    },

    postAddUser: function(req, res, next){

        let transporter = nodemailer.createTransport({
            service: 'gmail',
            auth: {
                user: 'everlastingpearl2@gmail.com', 
                pass: 'vpszuqjxinmvskql'
              }
          });

          let mailOptions = {
            from: 'everlastingpearl2@gmail.com', 
            to: req.body.email,
            subject: 'Account Created',
            text: 'Your Account Has Been Created !!! ' + 'For your credential. Your Email is ' + req.body.email + ' and your password is ' + req.body.password
        };

        transporter.sendMail(mailOptions, (err, data) => {
            if (err) {
                console.log(err);
            }else{
                const data = req.body
                generateUserId()
                .then(function(id){
                    data.User_id=id
                    bcrypt.hash(data.password, saltRounds, function(err, hash) {
                        connection.query("INSERT INTO `user`(`User_id`, `Fname`, `Mname`, `Lname`, `Email`, `Password`, `bday`, `age`, `section`, `studentid`, `gender`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [data.User_id, data.fname, data.mname, data.lname, data.email, hash, data.bday, data.age, data.section, data.studentid, data.gender], function(Drerr, Drrows){
                            if(Drerr){
                                console.log(Drerr)
                            }else{
                                req.flash('success', 'Successfully Add User')
                                res.redirect("/admin/dashboard") 
                                }
                            }
                        )
                    })	
                })
                .catch((err) => console.log(err))
            }

        });

    },

    postAddStaff: function(req, res, next){
        const data = req.body

        generateUserId()
        .then(function(id){
            data.User_id=id
            bcrypt.hash(data.password, saltRounds, function(err, hash) {
                connection.query("INSERT INTO `staff`(`Staff_id`, `Fname`, `Mname`, `Lname`, `Email`, `Password`, `Role`, `bday`, `age`, `gender`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [data.User_id, data.fname, data.mname, data.lname, data.email, hash, data.role, data.bday, data.age, data.gender], function(Drerr, Drrows){
                    if(Drerr){
                        console.log(Drerr)
                    }else{
                        req.flash('success', 'Successfully Add Staff')
                        res.redirect("/admin/dashboard") 
                        }
                    }
                )
            })	
        })
        .catch((err) => console.log(err))
    },

    
}