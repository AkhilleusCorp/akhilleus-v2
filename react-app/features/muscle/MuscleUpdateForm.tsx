import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import MuscleApiGateway from "../../services/api/gateway/MuscleApiGateway.tsx";
import MuscleDTO from "../../services/api/dtos/MuscleDTO.tsx";
import {TextField} from "@mui/material";

type MuscleUpdateFormType = {
    muscle: MuscleDTO,
}

const MuscleUpdateForm: React.FC<MuscleUpdateFormType> = ({muscle}) => {
    const navigate = useNavigate();
    const [muscleUpdated, setMuscleUpdated] = useState<MuscleDTO>(muscle);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMuscleUpdated({
            ...muscleUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            await MuscleApiGateway.updateMuscle(muscle.id, muscleUpdated);
            navigate(websiteRoutes.muscle.details(muscle.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <div>
                <TextField id="outlined-basic" label="Name" variant="outlined" size="small" required={true}
                           name={"name"} value={muscleUpdated.name} onChange={handleInputChange} />
            </div>
        </SaveForm>
    )
}

export default MuscleUpdateForm;