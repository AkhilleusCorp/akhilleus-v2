import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import MuscleApiGateway from "../../services/api/gateway/MuscleApiGateway.tsx";
import {TextField} from "@mui/material";

type MuscleCreateFormType = {
    name: string;
}

const MuscleCreateForm: React.FC = () => {
    const [muscleCreate, setMuscleCreate] = useState<MuscleCreateFormType>({name: ''});
    const navigate = useNavigate();

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setMuscleCreate({
            ...muscleCreate,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            const muscle = await MuscleApiGateway.createMuscle(muscleCreate);
            navigate(websiteRoutes.muscle.details(muscle.id));
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

export default MuscleCreateForm;