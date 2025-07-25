const express = require('express');
const router = express.Router();
const auth = require('../middleware/auth'); // Keep this for protected POST
const Club = require('../models/Club');

// ✅ POST: Create club (protected)
router.post('/', auth, async (req, res) => {
  try {
    const { name, description, imageUrl } = req.body;
    const newClub = new Club({ name, description, imageUrl });
    await newClub.save();
    res.status(201).json({ message: 'Club created successfully', club: newClub });
  } catch (error) {
    res.status(500).json({ error: 'Server error' });
  }
});

// ✅ GET: Fetch all clubs (public)
router.get('/', async (req, res) => {
  try {
    const clubs = await Club.find();
    res.json(clubs);
  } catch (error) {
    res.status(500).json({ error: 'Could not fetch clubs' });
  }
});

module.exports = router;

