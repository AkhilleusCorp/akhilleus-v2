import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import {TextField} from "@mui/material";
import WorkoutApiGateway from "app/common/services/api/gateway/WorkoutApiGateway.tsx";
import SaveForm from "app/common/components/form/SaveForm.tsx";
import UserType from "app/common/utils/types/UserType.tsx";
import RouteSwitch from "app/common/services/router/RouteSwitch.tsx";

type WorkoutCreateFormType = {
    userType: UserType;
}

const WorkoutCreateForm: React.FC<WorkoutCreateFormType> = ({userType}) => {
    const [workoutCreate, setWorkoutCreate] = useState<{}>({name: ''});
    const navigate = useNavigate();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setWorkoutCreate({
            ...workoutCreate,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            const workout = await WorkoutApiGateway.createWorkout(workoutCreate);
            navigate(RouteSwitch.switch(userType).workout.details(workout.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <TextField id="outlined-basic" label="Name" variant="outlined" size="small"
                           name={"name"} required={true} onChange={handleInputChange} />
            </div>
        </SaveForm>
    )
}

export default WorkoutCreateForm;