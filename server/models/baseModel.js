import connection from "../bin/db.js";

export default class BaseModel {
    constructor() {
        this.connection = connection;
    }
}