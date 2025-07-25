const express = require('express');
const router = express.Router();
const Event = require('../models/Event');

// POST /api/events - Create a new event
router.post('/', async (req, res) => {
  try {
    const newEvent = new Event(req.body);
    await newEvent.save();
    res.status(201).json(newEvent);
  } catch (err) {
    res.status(500).json({ error: 'Failed to create event' });
  }
});

// GET /api/events/:clubId - Get events by club
router.get('/:clubId', async (req, res) => {
  try {
    const events = await Event.find({ clubId: req.params.clubId });
    res.json(events);
  } catch (err) {
    res.status(500).json({ error: 'Failed to fetch events' });
  }
});

module.exports = router;
