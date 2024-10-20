class UserDTO {
    id: number;
    username: string;
    email: string;
    type: string;
    status: string;
    registrationDate: string | null;
    lastModificationDate: string | null;
    lastLoginDate: string | null;
    lastCompletedWorkoutDate: string | null;
    dateFormat: string | null;
    weightUnit: string | null;
    distanceUnit: string | null;
    measurementUnit: string | null;


    constructor(
        id: number,
        username: string,
        email: string,
        type: string,
        status: string,
        registrationDate: string | null,
        lastModificationDate: string | null,
        lastLoginDate: string | null,
        lastCompletedWorkoutDate: string | null,
        dateFormat: string | null,
        weightUnit: string | null,
        distanceUnit: string | null,
        measurementUnit: string | null
    ) {
        this.id = id;
        this.username = username;
        this.email = email;
        this.type = type;
        this.status = status;
        this.registrationDate = registrationDate;
        this.lastModificationDate = lastModificationDate;
        this.lastLoginDate = lastLoginDate;
        this.lastCompletedWorkoutDate = lastCompletedWorkoutDate;
        this.dateFormat = dateFormat;
        this.weightUnit = weightUnit;
        this.distanceUnit = distanceUnit;
        this.measurementUnit = measurementUnit;
    }

}

export default UserDTO;