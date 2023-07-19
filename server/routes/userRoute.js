import UserController from '../controllers/userController.js';
import express from 'express';

const userRoute = express.Router();

const controller = new UserController();

userRoute.get('/', controller.index);
userRoute.post('/', controller.create);
userRoute.get('/:userId', controller.show);
userRoute.delete('/:userId', controller.deleteUser);

export default userRoute;