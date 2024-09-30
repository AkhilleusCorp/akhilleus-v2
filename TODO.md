## Refactoring
### API
 * Simplify fixtures creation using dataModel directly
### Website
### React APP
* Create a DeleteButton in react that handle 100% of the process

## API
### Documentation
 * Update documentation to handle data & extra sub field for all APIs
### User API
 * Handle timezone using UserConfiguration and use it in CustomSerializer
 * Create a dedicated API just to update password
### Muscle, Equipment, Movement
 * Add status
 * Implement DeleteOneByIdUseCase to deal with soft delete if object is used
### Configuration API
* Expose an API that contain configuration information
  * enum for UserStatus, UserType
  * enum for WorkoutStatus, WorkoutVisibility

## Website

## React APP
### Security
 * Fetch and use token to make api call in order to secure it (and remove public access)
### Form
 * create drop down for enum field like status and visibility
### Equipment
 * List
 * Details
 * Add
 * Update
 * Delete
### Muscle
* List
* Details
* Add
* Update
* Delete
### Movement
 * List
 * Details
 * Add
 * Update
 * Delete