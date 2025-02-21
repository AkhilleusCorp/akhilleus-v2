## Refactoring
### API
 * Simplify fixtures creation using dataModel directly
 * Handle timezone using UserConfiguration and use it in CustomSerializer
 * Create a dedicated API just to update password
 * Do not allow to delete if the object is used (deactivate instead)
### React APP
 * Manipulate QueryId object instead of strings for Ids


## Features
## API
 * Workout start
 * ExerciseGroup rest time between set
 * Add .env var HTML wrap api response to see provider
## Website
## React APP
### Member area
#### Workouts
 * agenda (history + planned)
 * start
#### Exercise 
 * update type
 * remove one
### Security
 * Migrate registration to react app
 * Migrate login to react app
 * use redux for getOne (used in preview and details)
### Muscle, Equipment, Movement
* Do not allow to delete if the object is used
### Security
 * Fetch and use token to make api call in order to secure it (and remove public access)