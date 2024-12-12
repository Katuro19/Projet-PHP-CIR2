BEGIN TRANSACTION;

CREATE TABLE IF NOT EXISTS "expertise" (
	"id" SERIAL PRIMARY KEY NOT NULL UNIQUE,
	"name"	TEXT NOT NULL
);


CREATE TABLE IF NOT EXISTS "locations" (
	"id" SERIAL PRIMARY KEY NOT NULL UNIQUE,
	"name" TEXT NOT NULL,
	"postcode"	TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS "patients" (
	"id" SERIAL PRIMARY KEY NOT NULL UNIQUE,
	"firstname" TEXT NOT NULL,
	"lastname"	TEXT NOT NULL,
	"email" TEXT NOT NULL,
	"phone" TEXT NOT NULL,
	"password" TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS "doctors" (
	"id" SERIAL PRIMARY KEY NOT NULL UNIQUE,
	"firstname"	TEXT NOT NULL,
	"lastname"	TEXT NOT NULL,
	"email"	TEXT NOT NULL,
	"phone" TEXT NOT NULL,
	"password"	TEXT NOT NULL DEFAULT 'password',
	"postcode" TEXT NOT NULL,
	"expertise_id" INTEGER NOT NULL,
	FOREIGN KEY("expertise_id") REFERENCES "expertise"("id") ON DELETE CASCADE

);


CREATE TABLE IF NOT EXISTS "rendezvous" (
	"id" SERIAL PRIMARY KEY NOT NULL UNIQUE,
	"date" TEXT NOT NULL,
	"start"	TEXT NOT NULL,
	"end" TEXT NOT NULL,
	"patient_id" INTEGER,
	"doctor_id" INTEGER NOT NULL,
	"location_id" INTEGER NOT NULL,
	FOREIGN KEY("patient_id") REFERENCES "patients"("id") ON DELETE CASCADE,
	FOREIGN KEY("location_id") REFERENCES "locations"("id") ON DELETE CASCADE,
	FOREIGN KEY("doctor_id") REFERENCES "doctors"("id") ON DELETE CASCADE

);

-- DONT FORGET TO CHECK AND COMMIT !!



