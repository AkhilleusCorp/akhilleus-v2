## Quality / Testing
* Add unit and integration tests on SF part
* Plug coverall to upload code coverage automatically

## Functionnalities
### User
#### Status
* Add status (create, activated, deactivated, deleted etc ?)
* Add status management in updateOneById API
* Make status updatable from UserDetails page in react
#### Type
* Only allow to create Admin and Coach from the Create page in react (member should only be created through registration)
#### Registration
* Add a registration form for Coach

### Workout
#### Basic API
* Create basic CRUD for workout with minimal DataModel
    * title
    * status (draft, publish, suspended)
    * visibility (public, owner, follower, client, clients)
    * visibleFrom (date)
    * visibleTo (date)