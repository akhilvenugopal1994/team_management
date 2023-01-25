# team_management
managing Team members [Adding/Deleting]


#Installation

Step 1. Clone the repository


Step 2. Switch to the repo folder <br>
 <i> cd project_folder_name </i>

Step 3. Install all the dependencies using composer<br>
 <i> composer install  </i>
Note :: create '.htaccess' file in public folder and '.env' in root folder if not created from 'composer intall'

Step 4. make configuration changes in the .env file (database)<br>
<i> cp .env.example .env  </i>

Step 5. Generate a new application key<br>
<i> php artisan key:generate  </i>

Step 6. Run the database migrations (Set the database connection in .env before migrating)<br>
<i> php artisan migrate  </i>

Step 7. Run the database seeder for dummy datas<br>
<i> php artisan db:seed  </i>

Step 8. Start the local development server<br>
<i> php artisan serve  </i><br><br><br>
You can now access the server at http://localhost:8000


