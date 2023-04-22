const express = require('express')
const router = express.Router()
const basic = require('../controller/basic')

const mysql = require("mysql2");
const configDB = require("../config/configDB");
const connection = mysql.createConnection(configDB.connection);

router.get(['/', '../frontend/user/login'], basic.getHome)

router.get("/dashboard", (req, res) => {
    connection.query(
      "select * from appointment where User_id=? and Not_pending=false and history=false;",
      [req.user.User_id],
      (err, rows) => {
        if (err) console.log(err);
        else if (rows.length >= 0) {
          connection.query(
            "select * from appointment where User_id=? and Not_pending=true and history=false;",
            [req.user.User_id],
            (err2, row2) => {
            if(err2){
              console.log("err in presc id 2: "+err2)
              res.redirect("/user/dashboard")
            }
            else{
              console.log("HERE: " + req.user.User_id);
              return res.render("../frontend/user/dashboard", {
                row: rows,
                row2: row2,
                id: "",
              });
              
            }
          })
        } else {
          console.log("no appointments");
          req.flash("alert", "No appointments in list");
          res.render("../frontend/user/dashboard", {
            row: rows,
            id: "",
          });
          // res.redirect('/doctor/dashboard')
        }
      }
    );
  });


router.get('/appointment', basic.getAppointment)

router.post('/appointment', basic.postAppointment)

router.get("/removed/:id", (req, res) => {
  connection.query("delete from appointment where appointment_id=?; ", [req.params.id], (err ,result) => {
    if(err){
        console.log(err)
    } else {
        req.flash("success", "Deleted Appointment")
        res.redirect("/user/dashboard");
    }
})
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
        res.redirect("/user/dashboard");
      } else {
        req.flash("success", "Appointment Done");
        console.log(result);
        res.redirect("/user/dashboard");;
      }
    }
  );
});

router.get('/history', (req, res) => {
  connection.query(
    "select * from appointment where User_id=? and Not_pending=false and history=false;",
    [req.user.User_id],
    (err, rows) => {
      if (err) console.log(err);
      else if (rows.length >= 0) {
        connection.query(
          "select * from appointment where User_id=? and Not_pending=true and history=true;",
          [req.user.User_id],
          (err2, row2) => {
          if(err2){
            console.log("err in presc id 2: "+err2)
            res.redirect("/user/history")
          }
          else{
            console.log("HERE: " + req.user.User_id);
            return res.render("../frontend/user/history", {
              row: rows,
              row2: row2,
              id: "",
            });
            
          }
        })
      } else {
        console.log("no appointments");
        req.flash("alert", "No appointments in list");
        res.render("../frontend/user/history", {
          row: rows,
          id: "",
        });
        // res.redirect('/doctor/dashboard')
      }
    }
  );
});

router.get("/emailchange", basic.getEmailChange);

router.put("/emailchange", basic.putEmailChange);

router.get("/passwordchange", basic.getPasswordChange);

router.put("/passwordchange", basic.putPasswordChange);

router.get('/grades', (req, res) => {
  connection.query(
    "select * from grade where User_id=?",
    [req.user.User_id],
    (err, rows) => {
      if (err){
        console.log(err);
      }else{
        console.log("HERE: " + req.user.User_id);
        return res.render("../frontend/user/grades", {
          rows: rows,
          id: "",
        });
      }

          
    }
  )
}),

router.get('/announcement', (req, res) => {
  connection.query(
    "select * from announcement",
    (err, rows) => {
      if (err){
        console.log(err);
      }else{
        console.log("HERE: " + req.user.User_id);
        return res.render("../frontend/user/announcement", {
          rows: rows,
          id: "",
        });
      }

          
    }
  )
})


module.exports = router