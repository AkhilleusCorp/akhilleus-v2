import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import websiteRoutes from "../../services/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import MuscleApiGateway from "../../services/api/gateway/MuscleApiGateway.tsx";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import SelectInput from "../../components/input/SelectInput.tsx";
import muscleRegistries from "../../constants/muscleRegistries.tsx";

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

    const handleSelectChange = (event: SelectChangeEvent) => {
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
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="Name" variant="outlined" size="small"
                               name={"name"} required={true} onChange={handleInputChange}/>
                </FormControl>

                <SelectInput label="Status" name={"status"} value={null}
                             options={muscleRegistries.status} required={true} onSelectChange={handleSelectChange}/>
            </Grid>
        </SaveForm>
    )
}

export default MuscleCreateForm;