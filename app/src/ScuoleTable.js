import ScuoleRiga from "./ScuoleRiga";
export default function ScuoleTable( props ) {

    const scuole = props.myArray;
    const ricarica = props.caricaScuola;

    return (
        <table border="1">
          <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>indirizzo</th>
            <th>---</th>
          </tr>
          </thead>
            {scuole.map(a => (
              <ScuoleRiga scuole={a} ricarica={ricarica} />
            ))}
        </table>
    );
}

