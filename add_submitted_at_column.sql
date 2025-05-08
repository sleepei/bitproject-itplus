-- Add submitted_at column to contacts table to store submission timestamp
ALTER TABLE contacts ADD COLUMN submitted_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
