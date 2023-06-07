module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
  },
  extends: ["eslint:recommended", "plugin:prettier/recommended"],
  plugins: ["prettier"],
  // add your custom rules here
  rules: {
    "no-console": 0,
    "no-debugger": "error",
    strict: 0,
  },
  parser: "@babel/eslint-parser",
};
