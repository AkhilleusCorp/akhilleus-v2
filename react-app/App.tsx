import '@fontsource/roboto/300.css';
import '@fontsource/roboto/400.css';
import '@fontsource/roboto/500.css';
import '@fontsource/roboto/700.css';


import * as ReactDOM from "react-dom/client";
import Router from "./infrastructure/router/Router.tsx";
import { CssBaseline } from '@mui/material';
import { ThemeProvider, createTheme } from '@mui/material/styles';

const theme = createTheme();
const root = document.getElementById("root")!;

ReactDOM.createRoot(root).render(
        <ThemeProvider theme={theme}>
            <CssBaseline />  {/* Ajoutez cette ligne pour charger les styles de base de Material-UI */}
            <Router />
        </ThemeProvider>
);