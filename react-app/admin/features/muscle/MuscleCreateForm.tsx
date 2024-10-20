import React, {useState} from 'react';
import {useNavigate} from "react-router-dom";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import MuscleApiGateway from "app/admin/services/api/gateway/MuscleApiGateway.tsx";
import websiteRoutes from "app/admin/services/router/websiteRoutes.tsx";
import SaveForm from "app/common/components/form/SaveForm.tsx";
import SelectInput from "app/common/components/input/SelectInput.tsx";
import muscleRegistries from "app/common/constants/muscleRegistries.tsx";

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