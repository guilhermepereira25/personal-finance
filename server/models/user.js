import BaseModel from "./baseModel.js";

class User extends BaseModel {
    constructor() {
        super();
    }

    async getAll() {
        const sql = "SELECT id, username FROM user;";
        const [rows] = await this.connection.promise().query(sql);

        return rows;
    }

    async getOne(id) {
        const sql = "SELECT id, username FROM user WHERE id = ?;";
        const [rows] = await this.connection.promise().query(sql, [id]);

        return rows;
    }

    async insert() {
        const sql = "INSERT INTO user (username, password) VALUES (?, ?);";
        const [rows] = await this.connection.promise().query(sql, [username, password]);

        return rows;
    }
}

export default User;