const express = require('express')
const router = express.Router()
const authenticate = require('../controller/authenticate')
const authenticates = require('../controller/basic')

router.get('/user/register', authenticate.getUserRegister)

router.get('/user/login', authenticates.getHome)

router.post('/register', authenticate.postUserRegister)

router.get('/login', authenticates.getHome)

router.post('/admin/login', authenticate.postAdminLogin)

router.post('/user/login', authenticate.postUserLogin)

router.post('/staff/login', authenticate.postStaffLogin)

router.get('/logout', authenticate.logout)

module.exports = router