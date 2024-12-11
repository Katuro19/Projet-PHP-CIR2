BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "doctors" (
	"id" SERIAL PRIMARY KEY NOT NULL UNIQUE,
	"firstname"	TEXT NOT NULL,
	"lastname"	TEXT NOT NULL,
	"email"	TEXT NOT NULL,
	"phone" TEXT NOT NULL,
	"password"	TEXT NOT NULL DEFAULT 'password',
	"postcode" TEXT NOT NULL,
	"expertise" TEXT NOT NULL
	--PRIMARY KEY("id" ,SERIAL)
);


CREATE TABLE IF NOT EXISTS "patients" (
	"id" SERIAL PRIMARY KEY NOT NULL UNIQUE,
	"lastname"	TEXT NOT NULL,
	"firstname"	TEXT NOT NULL,
	"phone"	TEXT,
	"birth_date"	TEXT NOT NULL DEFAULT 01012000,
	"doctor_id" INTEGER,
	FOREIGN KEY("doctor_id") REFERENCES "doctors"("id") ON DELETE CASCADE
	-- PRIMARY KEY("id" SERIAL)
);
CREATE TABLE IF NOT EXISTS "glucose" (
	"id"	SERIAL PRIMARY KEY  NOT NULL UNIQUE,
	"patient_id" INTEGER NOT NULL,
	"value"	TEXT,
	"measurement_date"	TEXT,
	FOREIGN KEY("patient_id") REFERENCES "patients"("id") ON DELETE CASCADE
	-- PRIMARY KEY("id" SERIAL)
);

COMMIT;

