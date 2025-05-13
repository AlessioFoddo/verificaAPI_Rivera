export default function ScuoleTable( props ) {

    const scuole = props.myArray;

    return (
        <table>
          {scuole.map(a =>
            <tr>
              <td>{a.id}</td>
              <td>{a.nome}</td>
              <td>{a.indirizzo}</td>
            </tr>
            )}
        </table>
    );
}

