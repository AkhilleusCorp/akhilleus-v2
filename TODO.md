## Refactoring
### API
 * Add default sort to all lists
 * Simplify fixtures creation using dataModel directly
 * Update documentation to handle data & extra sub field for all APIs
 * Handle timezone using UserConfiguration and use it in CustomSerializer
 * Create a dedicated API just to update password
 * add count usage on lists
 * Do not allow to delete if the object is used (deactivate instead)
### React APP
 * Manipulate QueryId object instead of strings for Ids


## Features
## API
## Website
## React APP
### Redux
 * use redux for getOne (used in preview and details)
### Muscle, Equipment, Movement
* Do not allow to delete if the object is used
### Security
 * Fetch and use token to make api call in order to secure it (and remove public access)