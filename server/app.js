import express from 'express';
import indexRouter from './routes/index.js';
import userRoute from './routes/userRoute.js';

const app = express();

app.use('/', indexRouter);
app.use('/user', userRoute);

export default app;