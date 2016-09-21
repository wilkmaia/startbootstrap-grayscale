<?php

require_once 'configs.php';

class Conn
{
	function __construct()
	{
		try
		{
			$this->connection = new PDO( "mysql:host=" . MYSQL_ADDR . ";dbname=" . DATABASE, DB_USERNAME, DB_PASSWORD );
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch( PDOException $e )
		{
			echo "Connection failed: " . $e->getMessage();
		}
	}
	
	function __destruct()
	{
		$this->connection = null;
	}
	
	function inscrever( $vals )
	{
		$nome = $this->verificar( $vals[8] );
		if( $nome !== 0 )
			return $nome; // Nome associado ao email registrado
		
		$stmt = $this->connection->prepare( "INSERT INTO inscricoes ( senha, nome, tipo, local, numero, cargo, cidade, estado, camisa, email, telefone ) VALUES ( :senha, :nome, :tipo, :local, :numero, :cargo, :cidade, :estado, :camisa, :email, :telefone ) " );
		
		$stmt->bindParam( ":nome", $vals[0] );
		$stmt->bindParam( ":tipo", $vals[1] );
		$stmt->bindParam( ":local", $vals[2] );
		$stmt->bindParam( ":numero", $vals[3] );
		$stmt->bindParam( ":cargo", $vals[4] );
		$stmt->bindParam( ":cidade", $vals[5] );
		$stmt->bindParam( ":estado", $vals[6] );
		$stmt->bindParam( ":camisa", $vals[7] );
		$stmt->bindParam( ":email", $vals[8] );
		$stmt->bindParam( ":telefone", $vals[9] );
		$stmt->bindParam( ":senha", $vals[10] );
		
		try
		{
			$stmt->execute();
		}
		catch ( PDOException $e )
		{
			return 0; // Erro
		}
		
		return 1; // Sucesso
	}
	
	function inscrever_concurso( $email, $senha )
	{
		$stmt = $this->connection->prepare( "SELECT id, nome, tipo FROM inscricoes WHERE email=:email AND senha=:senha" );
		
		$stmt->bindParam( ":email", $email );
		$stmt->bindParam( ":senha", $senha );
		
		try
		{
			$stmt->execute();
		}
		catch( PDOException $e )
		{
			return 0; // Erro
		}
		
		if( $stmt->rowCount() == 0 )
			return 0; // Erro
		
		$row = $stmt->fetch();
		
		$id = $row["id"];
		$nome = $row["nome"];
		$tipo = $row["tipo"];
		
		if( $tipo != "FDJ" )
			return 3;
		
		$stmt = $this->connection->prepare( "INSERT INTO concurso ( id, nome, email ) VALUES ( :id, :nome, :email )" );
		
		$stmt->bindParam( ":id", $id );
		$stmt->bindParam( ":nome", $nome );
		$stmt->bindParam( ":email", $email );
		
		try
		{
			$stmt->execute();
		}
		catch( PDOException $e )
		{
			if( strpos( $e->getMessage(), "STATE[23000]" ) != false )
				return 2; // Inscrição já realizada
			else
				return 0; // Erro
		}
		
		return 1; // Sucesso
	}
	
	function verificar( $email )
	{
		$stmt = $this->connection->prepare( "SELECT nome FROM inscricoes WHERE email=:email" );
		$stmt->bindParam( ":email", $email );
		
		$stmt->execute();
		
		if( $stmt->rowCount() != 0 )
			return $stmt->fetch()["nome"];
		else
			return 0;
	}
	
	function changePagSeguroStatus( $c, $s )
	{
		$stmt = $this->connection->prepare( "UPDATE inscricoes SET statusPagSeguro=:s WHERE pagseguro=:c" );
		$stmt->bindParam( ":s", $s );
		$stmt->bindParam( ":c", $c );
		
		$stmt->execute();
	}
	
	function setPagSeguroCode( $e, $i )
	{
		$stmt = $this->connection->prepare( "UPDATE inscricoes SET statusPagSeguro=1, pagseguro=:i WHERE email=:e" );
		$stmt->bindParam( ":i", $i );
		$stmt->bindParam( ":e", $e );
		
		$stmt->execute();
	}
	
	function getCount( $t = "" )
	{
		if( $t != "" )
		{
			$stmt = $this->connection->prepare( "SELECT id FROM inscricoes WHERE tipo=:t" );
			$stmt->bindParam( ":t", $t );
		}
		else
			$stmt = $this->connection->prepare( "SELECT id FROM inscricoes" );
		
		$stmt->execute();
		
		return $stmt->rowCount();
	}
}

?>