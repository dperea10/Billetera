const express = require('express');
const app = express();

    app.get('/', function(req, res) {
        res.send('Wallet');
    });

    app.listen(3000, function(){
        console.log('Puerto 3000');
});npm