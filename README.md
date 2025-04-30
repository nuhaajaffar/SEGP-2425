Steps
Clone the repository:

git clone https://github.com/XpertBotTeam/hospital-system-mangment
cd hospital-system-mangment
Install PHP dependencies:

composer install
Install Node.js dependencies:

npm install
Compile assets:

npm run dev
Copy the .env.example file to .env and configure the environment variables:

cp .env.example .env
Generate an application key:

php artisan key:generate
Set up the database:

Create a database in your MySQL server.
Update the .env file with your database credentials.
Run migrations and seed the database:

php artisan migrate --seed
Serve the application:

php artisan serve
Access the application: Open your browser and go to http://localhost:8000
