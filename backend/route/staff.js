const express = require('express')
const router = express.Router()
const staff = require('../controller/staff')
const nodemailer = require('nodemailer')
const mysql = require("mysql2");
const configDB = require("../config/configDB");
const connection = mysql.createConnection(configDB.connection);
require('dotenv').config()

router.get('/login', staff.getStaffLogin)

router.post('/subject', staff.postSubject)

router.post('/grades', staff.postGrades)

//This method will redirect to all appointment made by patient
router.get("/dashboard", (req, res) => {
    connection.query(
      "select a.*, Fname as Pname from appointment a, user p where Not_pending=false and Role= ? and a.user_id=p.user_id and a.history=false ;",
      [req.user.Role],
      (err, rows) => {
        if (err) console.log(err);
        else if (rows.length >= 0) {
          connection.query(
            "select a.*, Fname as Pname from appointment a, user p where a.user_id=p.user_id and Not_pending=true and history=false and a.staff_id=? ;",
            [req.user.Staff_id],
            (err2, row2) => {
            if(err2){
              console.log("err in presc id 2: "+err2)
              res.redirect("/staff/dashboard")
            }
            else if (row2.length >= 0) {
              connection.query(
                "select a.*, Fname as Pname from appointment a, user p where a.user_id=p.user_id and Not_pending=true and history=true and a.staff_id=? ;",
                [req.user.Staff_id],
                (err3, row3) => {
                  if(err3){
                    console.log("err in presc id 2: "+err3)
                    res.redirect("/staff/dashboard")
                  }
                  else{
                    console.log("HERE: " + req.user.Role);
                    return res.render("../frontend/staff/dashboard", {
                      row: rows,
                      row2: row2,
                      row3: row3,
                      id: "",
                    });
                    
                  }
                }
              )
            }
          })
        } else {
          console.log("no appointments");
          req.flash("alert", "No appointments in list");
          res.render("../frontend/staff/dashboard", {
            row: rows,
            id: "",
          });
          // res.redirect('/doctor/dashboard')
        }
      }
    );
  });

router.put("/confirm/:id", (req, res) => {

    let transporter = nodemailer.createTransport({
      service: 'gmail',
      auth: {
          user: process.env.EMAIL, 
          pass: process.env.GMAIL_PASSWORD
        }
    });

    let mailOptions = {
        from: 'thesisproject4.1@gmail.com', 
        to: req.body.email,
        subject: 'CVSU',
        text: 'Your Appointment Request has been Confirmed. ' + 'The Appointment will start at ' + req.body.start + ' and will end at ' + req.body.end
    };

    transporter.sendMail(mailOptions, (err, data) => {
        if (err) {
            console.log(err);
        }else{
            console.log('Email sent!!!');
            connection.query(
              "update appointment set Appointment_Time=NOW(), Not_pending=true, start=?, end=?, Staff_id=? where Appointment_id=?",
              [
                req.body.start,
                req.body.end,
                req.user.Staff_id,
                req.params.id,
              ],
              (err, result) => {
                if (err) {
                  console.log(err);
                  res.redirect("/staff/dashboard");
                } else {
                  req.flash("success", "Appointment Confirmed");
                  console.log(result);
                  res.redirect("/staff/dashboard");;
                }
              }
            );
        }
    });


});

router.get("/confirmed", (req, res) => {
  connection.query(
    "select a.*, Fname as Pname from appointment a, user p where Not_pending=true and history=false and Role= ? and a.user_id=p.user_id ;",
    [req.user.Role],
    (err, rows) => {
      if (err) console.log(err);
          else{
            console.log("HERE: " + req.user.Role);
            return res.render("../frontend/staff/confirm", {
              row: rows,
              id: "",
            });
            
          }

    }
  );
});

router.get("/grade", (req, res) => {
  connection.query(
    "select a.*, Fname as Pname from grade a, user p where Staff_id= ? and a.user_id=p.user_id ;",
    [req.user.Staff_id],
    (err, rows) => {
      if (err) console.log(err);
      else if (rows.length >= 0){
        connection.query("select * from user", 
          (err1, rows1) => {
            if (err1) console.log(err1);
            else if (rows1.length >= 0){
              connection.query("select * from subjec",
              (err2, rows2) => {
                if (err2) console.log(err2);
                else{
                  console.log("HERE: " + req.user.Role);
                  return res.render("../frontend/staff/grade", {
                    row: rows,
                    rows1: rows1,
                    rows2: rows2,
                    id: "",
                  });
                  
                }
              } 
              )
            }
          }
          )
      }

    }
  );
});

router.get("/delete/:id", (req, res) => {
  connection.query(
    "update appointment set history=true, Staff_id=? where Appointment_id=?",
    [
      req.user.Staff_id,
      req.params.id,
    ],
    (err, result) => {
      if (err) {
        console.log(err);
        res.redirect("/staff/dashboard");
      } else {
        req.flash("success", "Appointment Done");
        console.log(result);
        res.redirect("/staff/dashboard");;
      }
    }
  );
});

router.get('/history', (req, res) => {
  connection.query(
    "select a.*, Fname as Pname from appointment a, user p where Not_pending=true and history=true and Role= ? and a.user_id=p.user_id ;",
    [req.user.Role],
    (err, rows) => {
      if (err) console.log(err);
          else{
            console.log("HERE: " + req.user.Role);
            return res.render("../frontend/staff/history", {
              row: rows,
              id: "",
            });
            
          }

    }
  );
})

router.get("/removed/:id", (req, res) => {
  connection.query("delete from appointment where appointment_id=?; ", [req.params.id], (err ,result) => {
    if(err){
        console.log(err)
    } else {
        req.flash("success", "Deleted Appointment")
        res.redirect("/staff/history");
    }
})
});

router.get("/deletegrade/:id", (req, res) => {
  connection.query("delete from grade where Grade_id=?; ", [req.params.id], (err ,result) => {
    if(err){
        console.log(err)
    } else {
        req.flash("success", "Deleted Grade")
        res.redirect("/staff/grade");
    }
})
});

router.get('/appointment', staff.getAppointment)

router.post('/appointment', staff.postAppointment)

module.exports = router