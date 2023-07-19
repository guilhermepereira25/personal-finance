import IndexController from '../controllers/indexController.js';
import express from 'express';

const indexRouter = express.Router();
const controller = new IndexController();

indexRouter.get('/', controller.index);

export default indexRouter;