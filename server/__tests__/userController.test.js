const UserController = require('../controllers/userController');

describe('UserController', () => {
  let userController;

  beforeEach(() => {
    userController = new UserController();
  });

  describe('create', () => {
    it('should return a JSON response with a message and status', () => {
      const req = {};
      const res = {
        status: 200,
        header: jest.fn().mockReturnThis(),
        json: { message: 'Post request from server!', status: 200 },
      };
      const next = jest.fn();

      userController.create(req, res, next);

      expect(res.status).toHaveBeenCalledWith(200);
      expect(res.header).toHaveBeenCalledWith('Content-Type', 'application/json');
      expect(res.header).toHaveBeenCalledWith('Access-Control-Allow-Origin', '*');
      expect(res.json).toHaveBeenCalledWith({ message: 'Post request from server!', status: 200 });
    });
  });

  describe('index', () => {
    it('should return a JSON response with a message and status', () => {
      const req = {};
      const res = {
        status: jest.fn().mockReturnThis(),
        header: jest.fn().mockReturnThis(),
        json: jest.fn(),
      };
      const next = jest.fn();

      userController.index(req, res, next);

      expect(res.status).toHaveBeenCalledWith(200);
      expect(res.header).toHaveBeenCalledWith('Content-Type', 'application/json');
      expect(res.header).toHaveBeenCalledWith('Access-Control-Allow-Origin', '*');
      expect(res.json).toHaveBeenCalledWith({ message: 'Hello from server!', status: 200 });
    });
  });

  describe('deleteUser', () => {
    it('should return a JSON response with a message, status, and id', () => {
      const req = { params: { id: 123 } };
      const res = {
        status: jest.fn().mockReturnThis(),
        header: jest.fn().mockReturnThis(),
        json: jest.fn(),
      };
      const next = jest.fn();

      userController.deleteUser(req, res, next);

      expect(res.status).toHaveBeenCalledWith(200);
      expect(res.header).toHaveBeenCalledWith('Content-Type', 'application/json');
      expect(res.header).toHaveBeenCalledWith('Access-Control-Allow-Origin', '*');
      expect(res.json).toHaveBeenCalledWith({ message: 'Hello from server!', status: 200, id: 123 });
    });
  });

  describe('show', () => {
    it('should return a JSON response with a message, status, and id', () => {
      const req = { params: { id: 123 } };
      const res = {
        status: jest.fn().mockReturnThis(),
        header: jest.fn().mockReturnThis(),
        json: jest.fn(),
      };
      const next = jest.fn();

      userController.show(req, res, next);

      expect(res.status).toHaveBeenCalledWith(200);
      expect(res.header).toHaveBeenCalledWith('Content-Type', 'application/json');
      expect(res.header).toHaveBeenCalledWith('Access-Control-Allow-Origin', '*');
      expect(res.json).toHaveBeenCalledWith({ message: 'Request done with success!', status: 200, id: 123 });
    });
  });
});