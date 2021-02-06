const express = require('express');
const router = express.Router()
const { curl, GetStr } = require('one7-utils')

router.get('/', async (req, res) => {

    let lista = req.query.lista
    let [cc, mes, ano, cvv] = lista.split(/\/|\||\\|\;|\:|\»/g)

    let d1 = await curl({
        url: `http://191.235.96.80/bb.php?lista=${lista}`,
        method: "GET",
    })

    res.send(d1)

})

module.exports = router