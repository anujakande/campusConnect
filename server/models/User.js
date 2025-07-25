const mongoose = require('mongoose');

const userSchema = new mongoose.Schema({
  name: String,
  email: String,
  password: String,
  role: { type: String, enum: ['student', 'club_admin'], default: 'student' },
  clubId: { type: mongoose.Schema.Types.ObjectId, ref: 'Club' }
});

module.exports = mongoose.model("User", userSchema);

