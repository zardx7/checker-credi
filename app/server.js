const express = require('express')
const { curl } = require('one7-utils')
const cors = require('cors')
const path = require('path')
const app = express();

app.use(cors())
app.use(express.json())
app.use(express.urlencoded({ extended: true }))
app.use(express.static(path.join(__dirname, '../assets/'))) 

app.get('/', (resq, res) => {
    res.sendFile('index.html', { root: path.join(__dirname, '../assets/') })
})

const api = require('./api')
app.use('/api', api)


app.listen(process.env.PORT || 3000)