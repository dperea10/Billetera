exports.regWallet = function (req, res) {
    var url = ('http://localhost:85/Walletpt/public/index.php/wallet/soap/recharge?wsdl', 'wsdl');
    data = {
        document : req.body.document,
        movil: req.body.movil,
        value : req.body.value
    };
    var options = {};
    soap.createClient(url, options, function (err, client) {
        client.regwallet(data, function (err, result, envelope, soapHeader) {
            console.info(result);
            res.status(200).jsonp({status : "ok"});
        })
    });

};


exports.conWallet = function (req, res) {
    var url = ('http://localhost:85//Walletpt/public/index.php/wallet/soap/consult?wsdl','wsdl');
    data = {
        document : req.body.document,
        movil : req.body.movil
    };
    var options = {};
    soap.createClient(url, options, function (err, client) {
        client.conwallet(data, function (err, result, envelope, soapHeader) {
            console.info(result);
            res.status(200).jsonp({status : "ok"});
        })
    });

};