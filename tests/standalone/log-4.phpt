--TEST--
Test for MongoLog (level variations)
--SKIPIF--
<?php require_once dirname(__FILE__) ."/skipif.inc"; ?>
--FILE--
<?php
require_once dirname(__FILE__) . "/../utils.inc";
function error_handler($code, $message)
{
	echo $message, "\n";
}

set_error_handler('error_handler');

echo "Warnings:\n";
MongoLog::setModule(MongoLog::ALL);
MongoLog::setLevel(MongoLog::WARNING);
$m = new Mongo("mongodb://$STANDALONE_HOSTNAME:$STANDALONE_PORT");

echo "Fine:\n";
MongoLog::setModule(MongoLog::ALL);
MongoLog::setLevel(MongoLog::FINE);
$m = new Mongo("mongodb://$STANDALONE_HOSTNAME:$STANDALONE_PORT");

echo "Info:\n";
MongoLog::setModule(MongoLog::ALL);
MongoLog::setLevel(MongoLog::INFO);
$m = new Mongo("mongodb://$STANDALONE_HOSTNAME:$STANDALONE_PORT");
?>
--EXPECTF--
Warnings:
Fine:
CON     FINE: found connection %s:%d;-;X;%d (looking for %s:%d;-;X;%d)
CON     FINE: send_packet: read from header: 36
CON     FINE: send_packet: data_size: 17
REPLSET FINE: finding candidate servers
REPLSET FINE: - all servers
REPLSET FINE: filter_connections: adding connections:
REPLSET FINE: - connection: type: STANDALONE, socket: 3, ping: 0, hash: %s:%d;-;X;%d
REPLSET FINE: filter_connections: done
REPLSET FINE: limiting by seeded/discovered servers
REPLSET FINE: - connection: type: STANDALONE, socket: 3, ping: 0, hash: %s:%d;-;X;%d
REPLSET FINE: limiting by seeded/discovered servers: done
REPLSET FINE: sorting servers by priority and ping time
REPLSET FINE: - connection: type: STANDALONE, socket: 3, ping: 0, hash: %s:%d;-;X;%d
REPLSET FINE: sorting servers: done
REPLSET FINE: selecting near servers
REPLSET FINE: selecting near servers: nearest is 0ms
REPLSET FINE: - connection: type: STANDALONE, socket: 3, ping: 0, hash: %s:%d;-;X;%d
REPLSET FINE: selecting near server: done
Info:
PARSE   INFO: Parsing mongodb://%s:%d
PARSE   INFO: - Found node: %s:%d
PARSE   INFO: - Connection type: STANDALONE
CON     INFO: mongo_get_read_write_connection: finding a STANDALONE connection
CON     INFO: is_ping: pinging %s:%d;-;X;%d
CON     INFO: is_ping: last pinged at %d; time: %dms
REPLSET INFO: pick server: random element 0
REPLSET INFO: - connection: type: STANDALONE, socket: 3, ping: 0, hash: %s:%d;-;X;%d

Notice: CON     INFO: freeing connection %s:%d;-;X;%d in Unknown on line 0
