
exports.emitPayment = function (req, res) {
    var url = ('http://localhost:85/Walletpt/public/index.php/payment/soap/emite?wsdl', 'wsdl');
    data = {
        value : req.body.value,
        document : req.body.document,
        email : req.body.email
       
    };
    var options = {};
    soap.createClient(url, options, function (err, client) {
        client.emitpayment(data, function (err, result, envelope, soapHeader) {
            console.info(result);
            res.status(200).jsonp({status : "ok"});
        })
    });

};


exports.confirmPayment = function (req, res) {
    var url = ('http://localhost:85/Walletpt/public/index.php/payment/soap/confirm?wsdl', 'wsdl');
    data = {
        token : req.body.token,
        document : req.body.document
    };
    var options = {};
    soap.createClient(url, options, function (err, client) {
        client.confirmpayment(data, function (err, result, envelope, soapHeader) {
            console.info(result);
            res.status(200).jsonp({status : "ok"});
        })
    });

};
