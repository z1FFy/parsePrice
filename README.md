# parsePrice
## Description
Parsing html price file (table) &amp; inserting in to MySQL database. After generation reporting email messages.
## Usage
* config.php - configuration file, setting, db params.
* index.php - main tamplate.
* parse.sql - sql query for create table in db.

Parse simple html table:

$priceUrl = PRICE_URL;

$parser = new Parser();

$parsedArray = $parser->parse($priceUrl);
