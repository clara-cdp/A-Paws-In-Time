
<img width="2187" height="793" alt="APIT_logico" src="https://github.com/user-attachments/assets/a7220e15-7b22-40de-88c0-279debe87814" />

# A Point-and-Click Adventure Built with Laravel

A Paws in Time is a narrative-driven point-and-click adventure where players must navigate a world frozen 
in a temporal glitch to rescue their kidnapped feline companion. Players must infiltrate a mad scientist’s 
mansion to disrupt a machine designed to halt history forever. Shifting between the Past and Present, 
players interact with a dynamic 2D environment, collecting era-specific items and solving logic-based 
puzzles to reach the Doctor's attic where the cat is trapped, 
restarting the clock before the "Perfect Moment" becomes a permanent cage.

## 🛠️ Tech

- **Framework:** Laravel 12
- **Frontend:** Blade Templates / livewire
- **Livewire:** Used for an interactive actions updates a real-time.
- **Database:** SQLite persistence seeded with JSON files that hold all the game data.
- **Styling:** Tailwind + CSS
- **javaScritp:** crucial for room rendering, drag map positions and eventListeners.
- **Authentication:** Implemented via Breeze. Includes Registration, Login, and Password Recovery via Mailpit/SMTP.
- **Service Layer*:* Implementation to power the Game Engine.
- **Custom 404:** A themed "Lost in Time" error page to handle ModelNotFound exceptions.
- **GitFlow:** Developed using a feature-branch workflow with documented Pull Requests.


## 📂 Project Requisits and Structure
### **ERR Diagram (MER):** database state act as a core for the game logic to work

_add new db diagram_


### MVC architecture enhanced with service Layers

**App/view**  
Renders the entire front end. Livewire acts as the Reactive View. When a player clicks a "Pick Up" button, 
it calls a method in a Livewire Component. The Livewire Component calls the GameEngine (Service),
which then updates the Model (Database).

**App/controllers**   
The Route hits the Controller. The Controller calls the GameEngine service and returns the View.   

**App/Models:**   
represent the data structure and the relationships.   
For example: User hasOne Player; Player belongsToMany Items (the inventory).

**App/Game classes** (Domain Services)Ñ
_The Brain of the game_   
_**GameStart:**_ Handles player creation and world rendering. Since each player has their own set of items, 
GameStart ensures the environment matches the player's saved state (Persistence), preventing "state leakage" 
between users by duplicating the game world for every new user.   

_**GameState:**_ Controls the game state. It tracks non-persistent variables during a session and bridges 
them with persistent database records (like the player's current Room ID or Timeline Stability score).   

_**GameAction:**_ validates the interactions. "Does the player actually have the Golden Key in their inventory 
table before they can open this door?"   
_**GameEngine:**_ "handle the database and the game state. Everytime an item is picked up or interacted with,
database is updated using livewire as bridge between them.



## 🚀 Getting Started
### Prerequisites

PHP 8.2+   
Composer  
Node.js & NPM   


### 👨🏻‍🔧Installation
#### 1. Clone the repository:
```
git clone https://github.com/clara-cdp/A-Paws-In-Time.git
```

- make sure you are on the right folder otherwise:
```
cd a-paws-in-time
```
#### 2. Install dependencies:
```
composer install
```
```
npm install 
```
```
npm run build
```
#### 3. Environment Setup:

copy enviroment file:
.env.example and name it .env

then run
----php artisan key:generate
Update your .env file with database 

```
APP_NAME='A Paws in Time'
```
```
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
 DB_DATABASE=database.sqlite
 DB_USERNAME=root
 DB_PASSWORD=
```
Generate aap key:
```
php artisan key:generate
```

#### 4.Run Migrations & Seeders:
```
php artisan migrate --seed
```
- if prompted: Would you like to create it? (yes/no) [yes]
- say yes

#### 5. Launch the game:
```
php artisan serve
```
- Visit http://localhost:8000 to start your adventure.

Ensure your .env is configured for Mailtrap or Mailpit to test the recovery emails.

![dancing_kitty](https://github.com/user-attachments/assets/03b12ee7-b55d-4173-91d5-748bd86da40c)

### NEXT TO COME:
A multyplayer user
story expansion up to 7 chapters.

