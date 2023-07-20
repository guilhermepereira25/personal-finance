import mysql from 'mysql';
import dbConfig from '../config/db_config.js';

const nodeEnv = process.env.NODE_ENV || 'development';

const connection = mysql.createConnection({
    host: dbConfig[nodeEnv].host,
    port: dbConfig[nodeEnv].port,
    database: dbConfig[nodeEnv].database,
    user: dbConfig[nodeEnv].user,
    password: dbConfig[nodeEnv].password,
});

connection.connect((err) => {
    if (err) throw err;
    console.log('Connected to MySQL Server!');
})

export default connection;