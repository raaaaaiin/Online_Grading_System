const LocalStrategy = require('passport-local').Strategy
const mysql = require('mysql2')
const configDB = require('./configDB')
const connection = mysql.createConnection(configDB.connection)
const bcrypt = require('bcrypt')
const generateUserId = require('../functions/generateuserid')
const jwt = require('jsonwebtoken')
const saltRounds = 10

module.exports = function(passport) {
    passport.serializeUser(function(user, done) {
        if( user.User_id )
            done(null, { User_id:user.User_id })
        else if(user.Staff_id )
            done(null, { Staff_id:user.Staff_id })
        else
            done(null, user)
    })

    passport.deserializeUser(function(user, done) {
        if( user.User_id ){
            connection.query("SELECT * FROM USER WHERE USER_ID = ?", [user.User_id], (err,rows) =>{
                done(null, rows[0])
            })
        }else if(user.Staff_id ){
            connection.query("SELECT * FROM STAFF WHERE STAFF_ID = ?", [user.Staff_id], (err,rows) =>{
                done(null, rows[0])
            })
        }else{
            done(null, user)
        }
    })

    passport.use('local-login-user', new LocalStrategy({
        usernameField : 'email', 
        passwordField : 'password',
        passReqToCallback : true 
    },
    function(req, email, password, done) {
        if(!email || !password)
        {
            return done(null, false, req.flash('error', 'Fill all required fields(* means field is required)'))
        }

        connection.query("SELECT * FROM USER WHERE EMAIL = ?",[email],function(err,rows){
            if(err){
                return done(err)
            }
            if(!rows.length){ 
                req.flash('error', 'No user found.')
                return done(null, false) 
            }

            bcrypt.compare(password, rows[0].Password, function(err, result) {
                if(err){
                    console.log(err)
                }
                if(!result){
                    req.flash('error', 'Wrong password.')
                    return done(null, false)
                }else{
                    const date = new Date();
                    const desc = "Login";
                    connection.query("INSERT INTO `actions`( `name`, `date`, `description`) VALUES (?, ?, ?)", [req.body.email, date, desc]);
                    return done(null, rows[0] )
                }
            });	
        })}
    ))


    passport.use('local-login-staff', new LocalStrategy({
        usernameField : 'email', 
        passwordField : 'password',
        passReqToCallback : true 
    },
    function(req, email, password, done) {
        if(!email || !password)
        {
            return done(null, false, req.flash('error', 'Fill all required fields(* means field is required)'))
        }

        connection.query("SELECT * FROM STAFF WHERE EMAIL = ?",[email],function(err,rows){
            if(err){
                return done(err)
            }
            if(!rows.length){ 
                req.flash('error', 'No user found.')
                return done(null, false) 
            }

            bcrypt.compare(password, rows[0].Password, function(err, result) {
                if(err){
                    console.log(err)
                }
                if(!result){
                    req.flash('error', 'Wrong password.')
                    return done(null, false)
                }else{
                    return done(null, rows[0] )
                }
            });	
        })}
    ))

}