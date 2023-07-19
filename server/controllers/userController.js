export default class UserController {
    create(req, res, next) {
        res.status(200);
        res.header('Content-Type', 'application/json');
        res.header('Access-Control-Allow-Origin', '*');
        res.json({message: 'Post request from server!', status: res.status});
    }

    index(req, res, next) {
        res.status(200);
        res.header('Content-Type', 'application/json');
        res.header('Access-Control-Allow-Origin', '*');
        res.json({message: 'Hello from server!', status: res.status});
    }

    deleteUser(req, res, next) {
        let id = req.params.id;
        res.status(200);
        res.header('Content-Type', 'application/json');
        res.header('Access-Control-Allow-Origin', '*');
        res.json({message: 'Hello from server!', status: res.status, id : id});
    }

    show(req, res, next) {
        let id = req.params.id;
        res.status(200);
    
        res.header('Content-Type', 'application/json');
        res.header('Access-Control-Allow-Origin', '*');
    
        res.json({message: 'Request done with success!', status: res.status, id : id});
    }
}