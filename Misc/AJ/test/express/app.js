var express = require('express');
var http = require('http');
var cors = require('cors');

var app = express();
app.use(express.bodyParser());
app.use(cors());
app.set('port', 80);

var data = [
  {"firstName": "Jeff", "lastname": "Winger"},
  {"firstName": "Troy", "lastname": "Barnes"},
  {"firstName": "Britta", "lastname": "Perry"},
  {"firstName": "Abed", "lastname": "Nadir"}
];

app.get('v1/session', function(req, res) {
    res.send(data);
});
app.post('v1/session', function(req, res) {
    res.send(req.body);
});