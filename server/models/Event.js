const mongoose = require('mongoose');

const eventSchema = new mongoose.Schema({
  clubId: { type: mongoose.Schema.Types.ObjectId, ref: 'Club', required: true },
  title: String,
  description: String,
  date: Date,
  venue: String,
  images: [String], // URLs to event photos
});

module.exports = mongoose.model('Event', eventSchema);
