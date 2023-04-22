const mysql = require('mysql2')
const configDB = require('../config/configDB')
const connection = mysql.createConnection(configDB.connection)
const bcrypt = require('bcrypt')
const saltRounds = 10
const generateUserId = require('../functions/generateuserid')


module.exports = {

    postSubject: function(req, res, next){
       
        const data = req.body
        connection.query("INSERT INTO `subjec`( `subject`, `description`) VALUES (?, ?)", [data.sub, data.desc], function(Drerr, Drrows){
            if(Drerr){
                console.log(Drerr)
            }else{
                req.flash('success', 'Successfully Post a subject.')
                res.redirect("/staff/grade") 
                }
            }
        )
    },

    postGrades: function(req, res, next){

        var failed = "Failed";
        var Drop = "Drop";
        var promoted = "Promoted";

        if(req.body.grade < 75){
            generateUserId()
            .then(function(id){
                data.Grade_id=id
            connection.query("INSERT INTO `grade`( `Grade_id`, `Subject`, `User_id`, `Grade`, `Staff_id`, `Staff_name`, `Remarks`) VALUES (?, ?, ?, ?, ?, ?, ?)", [data.Grade_id, data.subject, data.student, data.grade, req.user.Staff_id, req.user.Lname, failed], function(Drerr, Drrows){
                if(Drerr){
                    console.log(Drerr)
                }else{
                    req.flash('success', 'Successfully Add a Grade.')
                    res.redirect("/staff/grade") 
                    }
                }
            )
        })
        }else if(req.body.grade >= 75){
            generateUserId()
            .then(function(id){
                data.Grade_id=id
            connection.query("INSERT INTO `grade`( `Grade_id`, `Subject`, `User_id`, `Grade`, `Staff_id`, `Staff_name`, `Remarks`) VALUES (?, ?, ?, ?, ?, ?, ?)", [data.Grade_id, data.subject, data.student, data.grade, req.user.Staff_id, req.user.Lname, promoted], function(Drerr, Drrows){
                if(Drerr){
                    console.log(Drerr)
                }else{
                    req.flash('success', 'Successfully Add a Grade.')
                    res.redirect("/staff/grade") 
                    }
                }
            )
        })
        }
       
        const data = req.body


    },

    getStaffLogin:  function(req, res, next){
        return res.render('../frontend/staff/login')
    },

    getDashboard:  function(req, res, next){
        return res.render('../frontend/staff/dashboard')
    },

    getAppointment:  function(req, res, next){
        return res.render('../frontend/staff/appointment')
    },

    postAppointment: function(req, res, next){
        const data = req.body

        generateUserId()
        .then(function(id){
            data.Appointment_id=id
            bcrypt.hash(data.password, saltRounds, function(err, hash) {
                connection.query("INSERT INTO `appointment`(`Appointment_id`, `User_id`, `diagnose`, `symptoms`, `tested`, `neighbor`, `gender`, `date`, `Role`, `email`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [data.Appointment_id, req.user.Staff_id, data.diagnose, data.symptoms, data.tested, data.neighbor, data.gender, data.date, data.role, req.user.Email], function(Drerr, Drrows){
                    if(Drerr){
                        console.log(Drerr)
                    }else{
                        req.flash('success', 'Successfully Sent an Appointment. Please Wait for the Confirmation. Thankyou')
                        res.redirect("/staff/appointment") 
                        }
                    }
                )
            })	
        })
        .catch((err) => console.log(err))
    },

}