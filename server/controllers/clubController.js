const Club = require('../models/Club');

const createClub = async (req, res) => {
  const { name, description, imageUrl } = req.body;

  try {
    const club = new Club({
      name,
      description,
      imageUrl,
      createdBy: req.user.id // from JWT (we’ll add middleware)
    });

    await club.save();
    res.status(201).json({ message: "Club created successfully", club });
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
};

const getAllClubs = async (req, res) => {
  try {
    const clubs = await Club.find().sort({ createdAt: -1 });
    res.json(clubs);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
};

module.exports = { createClub, getAllClubs };
