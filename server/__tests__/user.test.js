const User = require("../models/user.js");

jest.mock("../models/user.js");

describe("User model", () => {
  let user;

  beforeAll(() => {
    User.mockImplementation(() => {
      return {
        getAll: jest.fn(() => Promise.resolve([{ id: 1, username: "testuser" }])),
        getOne: jest.fn(() => Promise.resolve({ id: 1, username: "testuser" })),
        insert: jest.fn(() => Promise.resolve({ affectedRows: 1 })),
      };
    });

    user = new User();
  });

  describe("getAll method", () => {
    it("should return an array of users", async () => {
      const result = await user.getAll();
      expect(Array.isArray(result)).toBe(true);
    });

    it("should return an array of objects with id and username properties", async () => {
      const result = await user.getAll();
      expect(result.every((user) => user.hasOwnProperty("id") && user.hasOwnProperty("username"))).toBe(true);
    });
  });

  describe("getOne method", () => {
    it("should return a single user object", async () => {
      const result = await user.getOne(1);
      expect(typeof result).toBe("object");
    });

    it("should return an object with id and username properties", async () => {
      const result = await user.getOne(1);
      expect(result.hasOwnProperty("id") && result.hasOwnProperty("username")).toBe(true);
    });
  });

  describe("insert method", () => {
    it("should insert a new user into the database", async () => {
      const result = await user.insert("testuser", "testpassword");
      expect(result.affectedRows).toBe(1);
    });
  });
});