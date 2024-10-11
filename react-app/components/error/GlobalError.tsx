import * as React from 'react';
import Box from '@mui/material/Box';
import {Alert} from "@mui/material";

type GlobalErrorType = {
    error: string | null;
}

const GlobalError: React.FC<GlobalErrorType> = ({ error }) => {
    return (
        <>
            { error && (
                <Box sx={{ display: 'flex' }}>
                    <Alert severity="error">{error}</Alert>
                </Box>
            )}
        </>
    );
}

export default GlobalError;