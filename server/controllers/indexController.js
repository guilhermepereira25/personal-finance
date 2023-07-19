export default class IndexController {
    index(req, res, next) {
        res.status(200);
        res.json({message: 'Hello from server!'});
    }
}