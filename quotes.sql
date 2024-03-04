DROP TABLE IF EXISTS quotes;
DROP TABLE IF EXISTS authors;
DROP TABLE IF EXISTS categories;


CREATE TABLE authors(
   id SERIAL PRIMARY KEY NOT NULL,
   name VARCHAR NOT NULL
);

CREATE TABLE categories(
   id SERIAL PRIMARY KEY NOT NULL,
   name VARCHAR NOT NULL
);

CREATE TABLE quotes(
   id SERIAL PRIMARY KEY NOT NULL,
   quote VARCHAR NOT NULL,
   author_id INT NOT NULL,
   category_id INT NOT NULL,
	
	CONSTRAINT FK_authorid FOREIGN KEY(author_id)
        REFERENCES authors(id),
	CONSTRAINT FK_categoryid FOREIGN KEY(category_id)
        REFERENCES categories(id)
	
);


WITH authors_function AS (
  INSERT INTO authors (name)
  VALUES ('Nelson Mandela'), ('Walt Disney'), ('Steve Jobs'), ('Mahatma Gandhi'), ('Eleanor Roosevelt'),('Mother Teresa'),('Franklin D. Roosevelt'),
  ('Martin Luther King Jr.'),('Benjamin Franklin'), ('Helen Keller'),('Aristotle'), ('Oprah Winfrey'), ('James Cameron'), ('John Lennon'),('Ralph Waldo Emerson'),
  ('Oscar Wilde'),('Maya Angelou'),('Henry David Thoreau'),('Abraham Lincoln'),('Babe Ruth'),('Thomas A. Edison'), ('Dr. Seuss')
  RETURNING id, name
),
category_function AS (
  INSERT INTO categories (name)
  VALUES ('Philosophy'), ('Entertainment'), ('Technology'), ('Politics'),('Civil Rights'), ('Inventors'), ('Author'),('poet'),('Sports')
  RETURNING id, name
)
INSERT INTO quotes (quote, category_id, author_id)
VALUES 
  ('The greatest glory in living lies not in never falling, but in rising every time we fall.', 
  (SELECT id FROM category_function WHERE name = 'Philosophy'), (SELECT id FROM authors_function WHERE name = 'Nelson Mandela')),
  ('The way to get started is to quit talking and begin doing.', 
  (SELECT id FROM category_function WHERE name = 'Entertainment'), (SELECT id FROM authors_function WHERE name = 'Walt Disney')),
  ('Your time is limited, so don''t waste it living someone else''s life. Don''t be trapped by dogma – which is living with the results of other people''s thinking.', 
  (SELECT id FROM category_function WHERE name = 'Technology'), (SELECT id FROM authors_function WHERE name = 'Steve Jobs')),
  ('The future belongs to those who believe in the beauty of their dreams.', 
  (SELECT id FROM category_function WHERE name = 'Politics'), (SELECT id FROM authors_function WHERE name = 'Eleanor Roosevelt')),
  ('You must do the thing you think you cannot do.', 
  (SELECT id FROM category_function WHERE name = 'Politics'), (SELECT id FROM authors_function WHERE name = 'Eleanor Roosevelt')),
  ('You must be the change you wish to see in the world.', 
  (SELECT id FROM category_function WHERE name = 'Philosophy'), (SELECT id FROM authors_function WHERE name = 'Mahatma Gandhi')),
  ('Spread love everywhere you go. Let no one ever come to you without leaving happier.', 
  (SELECT id FROM category_function WHERE name = 'Philosophy'), (SELECT id FROM authors_function WHERE name = 'Mother Teresa')),
  ('The only thing we have to fear is fear itself.', 
  (SELECT id FROM category_function WHERE name = 'Politics'), (SELECT id FROM authors_function WHERE name = 'Franklin D. Roosevelt')),
  ('Darkness cannot drive out darkness: only light can do that. Hate cannot drive out hate: only love can do that.', 
  (SELECT id FROM category_function WHERE name = 'Civil Rights'), (SELECT id FROM authors_function WHERE name = 'Martin Luther King Jr.')),
  ('Well done is better than well said.', 
  (SELECT id FROM category_function WHERE name = 'Inventors'), (SELECT id FROM authors_function WHERE name = 'Benjamin Franklin')),
   ('The best and most beautiful things in the world cannot be seen or even touched - they must be felt with the heart.', 
  (SELECT id FROM category_function WHERE name = 'Author'), (SELECT id FROM authors_function WHERE name = 'Helen Keller')),
   ('It is during our darkest moments that we must focus to see the light.', 
  (SELECT id FROM category_function WHERE name = 'Philosophy'), (SELECT id FROM authors_function WHERE name = 'Aristotle')),
  ('If you look at what you have in life, you''ll always have more. If you look at what you don''t have in life, you''ll never have enough.', 
  (SELECT id FROM category_function WHERE name = 'Entertainment'), (SELECT id FROM authors_function WHERE name = 'Oprah Winfrey')),
  ('If you set your goals ridiculously high and it''s a failure, you will fail above everyone else''s success.', 
  (SELECT id FROM category_function WHERE name = 'Entertainment'), (SELECT id FROM authors_function WHERE name = 'James Cameron')),
  ('You may say I''m a dreamer, but I''m not the only one. I hope someday you''ll join us. And the world will live as one.', 
  (SELECT id FROM category_function WHERE name = 'Entertainment'), (SELECT id FROM authors_function WHERE name = 'John Lennon')),
  ('Do one thing every day that scares you.', 
  (SELECT id FROM category_function WHERE name = 'Politics'), (SELECT id FROM authors_function WHERE name = 'Eleanor Roosevelt')),
  ('Do not go where the path may lead, go instead where there is no path and leave a trail.', 
  (SELECT id FROM category_function WHERE name = 'Author'), (SELECT id FROM authors_function WHERE name = 'Ralph Waldo Emerson')),
  ('Be yourself; everyone else is already taken.', 
  (SELECT id FROM category_function WHERE name = 'poet'), (SELECT id FROM authors_function WHERE name = 'Oscar Wilde')),
   ('You will face many defeats in life, but never let yourself be defeated.', 
  (SELECT id FROM category_function WHERE name = 'poet'), (SELECT id FROM authors_function WHERE name = 'Maya Angelou')),
  ('Go confidently in the direction of your dreams! Live the life you''ve imagined.', 
  (SELECT id FROM category_function WHERE name = 'Philosophy'), (SELECT id FROM authors_function WHERE name = 'Henry David Thoreau')),
  ('In the end, it''s not the years in your life that count. It''s the life in your years.', 
  (SELECT id FROM category_function WHERE name = 'Politics'), (SELECT id FROM authors_function WHERE name = 'Abraham Lincoln')),
  ('Never let the fear of striking out keep you from playing the game', 
  (SELECT id FROM category_function WHERE name = 'Sports'), (SELECT id FROM authors_function WHERE name = 'Babe Ruth')),
  ('In this life we cannot do great things. We can only do small things with great love.', 
  (SELECT id FROM category_function WHERE name = 'Philosophy'), (SELECT id FROM authors_function WHERE name = 'Mother Teresa')),
  ('Many of life''s failures are people who did not realize how close they were to success when they gave up.', 
  (SELECT id FROM category_function WHERE name = 'Inventors'), (SELECT id FROM authors_function WHERE name = 'Thomas A. Edison')),
   ('You have brains in your head. You have feet in your shoes. You can steer yourself any direction you choose.', 
  (SELECT id FROM category_function WHERE name = 'Author'), (SELECT id FROM authors_function WHERE name = 'Dr. Seuss'));


