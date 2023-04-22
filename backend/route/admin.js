const express = require('express')
const router = express.Router()
const admin = require('../controller/admin')
const authenticates = require('../controller/basic')

router.get('/login', admin.getAdminLogin)

router.get('/dashboard', admin.getAdminDashboard)

router.get('/audit', admin.getAdminAudit)

router.get('/logout', admin.getAdminLogout)

router.get('/adduser', admin.getAdminAddUser)

router.get('/addstaff', admin.getAdminAddStaff)

router.get('/deleteuser/:id', admin.getDeleteUser)

router.get('/announcement', admin.getAnnouncement)

router.post('/announcement', admin.postAnnouncement)

router.post('/addnewuser', admin.postAddUser)

router.post('/addnewstaff', admin.postAddStaff)

module.exports = router