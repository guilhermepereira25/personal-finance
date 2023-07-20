const dbConfig = {
    development: {
        host: 'localhost',
        port: 3306,
        database: 'personal_finance',
        user: 'app',
        password: 'node',
    },
    production: {
        host: 'localhost',
        port: 3306,
        database: 'personal_finance',
    }
}

export default dbConfig;