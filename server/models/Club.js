const mongoose = require('mongoose');

const clubSchema = new mongoose.Schema({
  name: { type: String, required: true, unique: true },
  description: String,
  createdBy: { type: mongoose.Schema.Types.ObjectId, ref: 'User' },
  imageUrl: String // Optional for logo/banner
}, { timestamps: true });

module.exports = mongoose.model("Club", clubSchema);
