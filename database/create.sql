CREATE TABLE IF NOT EXISTS VEHICLE_TYPE (
    vehicle_type_id INTEGER PRIMARY KEY,
    description TEXT
);

CREATE TABLE IF NOT EXISTS BID (
    bid_id INTEGER PRIMARY KEY,
    vehicle_price INTEGER,
    vehicle_type_id INTEGER,
    FOREIGN KEY(vehicle_type_id) REFERENCES VEHICLE_TYPE(vehicle_type_id)
);
