var soap = require('strong-soap').soap;

exports.createUser = function (req, res) {
    var url = ('http://localhost:85/Walletpt/public/index.php/user/soap?wsdl', 'wsdl');
    console.info("Req:" + req.body.email);
    data = {
        names : req.body.names,
        movil: req.body.movil,
        email : req.body.email,
        document : req.body.document
    };
    var options = {};
    soap.createClient(url, options, function (err, client) {
        client.createuser(data, function (err, result, envelope, soapHeader) {
            console.info(result);
            res.status(200).jsonp({status : "ok"});
        })
    });

};